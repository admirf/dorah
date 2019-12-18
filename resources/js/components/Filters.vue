<template>
    <div>
        <select :value="filter" class="form-control" @change="handleChange">
            <option value="">No Filter</option>
            <option value="only-me">Only My Issues</option>
        </select>

        <form ref="filterForm" :action="`/projects/${projectId}`" method="GET">
            <input name="_token" type="hidden" :value="csrf" />
            <input name="filter" type="hidden" :value="newFilter" />
        </form>
    </div>
</template>

<script>
    export default {
        name: "filters",
        props: ['projectId', 'filter'],
        data() {
            return {
                csrf: window.Laravel.csrfToken,
                newFilter: ''
            }
        },
        created() {
            this.newFilter = this.filter;
        },
        methods: {
            handleChange(e) {
                e.preventDefault();

                this.newFilter = e.target.value;

                this.$nextTick(() => {
                    this.$refs.filterForm.submit();
                })
            }
        }
    }
</script>

<style scoped>

</style>
