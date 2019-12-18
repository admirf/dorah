<template>
    <li class="list-group-item issue-bar d-block d-md-flex flex-row justify-content-between" :class="{'selected': (selectedIssue ? selectedIssue.id: -1) === issue.id}">
        <div>{{ issue.text }}</div>
        <div>
            <span class="badge badge-light">{{ issue.assignee ? issue.assignee.name: '' }}</span>
            <span class="badge badge-light">{{ 'ID: ' + issue.id }}</span>
            <span class="badge badge-dark">{{ issue.points || 0 }}</span>
        </div>
    </li>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "issue-bar",
        props: ['issue'],
        computed: {
            ...mapGetters([
                'selectedIssue'
            ])
        },
        created() {
            // console.log(this.issue);
        }
    }
</script>

<style scoped>
    .issue-bar:hover {
        cursor: pointer;
    }

    .selected {
        background-color: #38c172;
        color: #fff;
    }
</style>
