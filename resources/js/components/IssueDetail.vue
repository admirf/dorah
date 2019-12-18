<template>
    <div class="mt-3 card w-100 mb-3" v-if="selectedIssue">
        <div class="card-header">
            <a href="#" @click="closeIssueDetail"><i class="fas fa-times float-right"></i></a>
        </div>

        <div class="card-body">
            <div class="card-title">
                <span class="lead">{{ selectedIssue.text }}</span>
            </div>

            <textarea v-model="payload.description" class="d-block w-100 form-control mb-1" v-if="editDescription" rows="3">
            </textarea>
            <div v-else class="card-text mb-1">
                <div class="card">
                    <div class="card-body px-2 py-2">
                        {{ payload.description || 'No Description' }}
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a href="#"  @click="editDescription = ! editDescription">{{ editDescription ? 'Done': 'Edit description' }}</a>
            </div>

            <div class="form-group mt-2">
                <div class="mb-1"><strong>Reporter:</strong> <span class="float-right">{{ payload.reporter ? payload.reporter.name: '' }}</span></div>
                <div class="mb-3">
                    <label for="pointsInput"><strong>Story points:</strong></label>
                    <input placeholder="Story Points" v-model="payload.points" type="number" id="pointsInput" class="form-control" />
                </div>

                <label for="assigneeSelect"><strong>Assignee</strong></label>
                <select v-model="payload.assignee_id" class="form-control" id="assigneeSelect">
                    <option :value="null">No Assignee</option>
                    <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                </select>
            </div>

            <div class="row no-gutters mt-2">
                <div class="col-md-4 pr-md-1">
                    <button @click="updateIssue" class="btn btn-success w-100">Save</button>
                </div>
                <div class="col-md-4 pr-md-1 pl-md-1 mt-2 mt-md-0">
                    <button class="btn btn-primary w-100">Add</button>
                </div>
                <div class="col-md-4 pl-md-1 mt-2 mt-md-0">
                    <button @click="handleDelete" class="btn btn-danger w-100">{{ timer ? `Cancel (${deleteTime})`: 'Delete' }}</button>
                </div>
            </div>
        </div>

        <form :action="`/issues/${payload.id}`" method="POST" ref="updateForm">
            <input name="_method" type="hidden" value="PUT">
            <input name="_token" type="hidden" :value="csrf">
            <input name="description" type="hidden" v-model="payload.description">
            <input name="assignee_id" type="hidden" v-model="payload.assignee_id">
            <input name="points" type="hidden" v-model="payload.points">
        </form>

        <form :action="`/issues/${payload.id}`" method="POST" ref="deleteForm">
            <input name="_method" type="hidden" value="DELETE">
            <input name="_token" type="hidden" :value="csrf">
        </form>

    </div>
    <div class="mt-3 mb-3" v-else>
        <h5 class="text-center">Select an issue to see and modify its details.</h5>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "issue-detail",
        props: ['initialIssue', 'users'],
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

</style>
