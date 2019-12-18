<template>
    <div class="issue-detail card w-100" v-if="selectedIssue">
        <div class="card-header">
            <a href="#" @click="closeIssueDetail"><i class="fas fa-times float-right"></i></a>
        </div>

        <div class="card-body">
            <div class="card-title">
                {{ selectedIssue.text }}
            </div>

            <textarea v-model="payload.description" class="d-block w-100 form-control mb-1" v-if="editDescription" rows="3">
            </textarea>
            <div v-else class="card-text">
                {{ payload.description || '' }}
            </div>
            <a href="#" @click="editDescription = ! editDescription">{{ editDescription ? 'Done': 'Edit description' }}</a>

            <div class="row mt-2">
                <div class="col-md-4 px-1">
                    <button @click="updateIssue" class="btn btn-success w-100">Save</button>
                </div>
                <div class="col-md-4 px-1">
                    <button class="btn btn-primary w-100">Add</button>
                </div>
                <div class="col-md-4 px-1">
                    <button @click="handleDelete" class="btn btn-danger w-100">{{ timer ? `Cancel (${deleteTime})`: 'Delete' }}</button>
                </div>
            </div>
        </div>

        <form :action="`/issues/${payload.id}`" method="POST" ref="updateForm">
            <input name="_method" type="hidden" value="PUT">
            <input name="_token" type="hidden" :value="csrf">
            <input name="description" type="hidden" v-model="payload.description">
        </form>

        <form :action="`/issues/${payload.id}`" method="POST" ref="deleteForm">
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden" :value="csrf">
        </form>

    </div>
    <div class="issue-detail" v-else>
        <h3>Select an issue to see and modify its details.</h3>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "issue-detail",
        props: ['initialIssue'],
        data() {
            return {
                editDescription: false,
                timer: null,
                deleteTime: 0,
                deleteTimeTimer: null,
                payload: {},
                csrf: window.Laravel.csrfToken
            }
        },
        created() {
            if(this.initialIssue) {
                this.$store.commit('selectIssue', this.initialIssue);
            }
        },
        computed: {
            ...mapGetters([
                'selectedIssue'
            ])
        },
        watch: {
            selectedIssue: function (obj, old) {
                if(obj) {
                    this.payload = Object.assign({}, obj);
                }
            }
        },
        methods: {
            updateIssue() {
                let form = this.$refs.updateForm;
                form.submit();
            },

            handleDelete() {
                if (this.timer) {
                    clearTimeout(this.timer);
                    clearTimeout(this.deleteTimeTimer);
                    this.timer = null;
                    return;
                }

                this.deleteTime = 4;
                this.updateDeleteTime();

                this.timer = setTimeout(this.deleteIssue, 3000);
            },

            deleteIssue() {
                let form = this.$refs.deleteForm;
                form.submit();
            },

            updateDeleteTime() {
                if (this.deleteTime === 0) return;

                --this.deleteTime;

                this.deleteTimeTimer = setTimeout(this.updateDeleteTime, 1000);
            },

            closeIssueDetail() {
                this.$store.commit('selectIssue', null);
            }
        }
    }
</script>

<style scoped>
    .issue-detail {
        margin-top: 62px;
    }
</style>
