<template>
    <ul class="list-group">
        <issue-bar v-for="(issue, index) in issues" :key="index" :issue="issue" @click.native="selectIssue(issue)">
        </issue-bar>
    </ul>
</template>

<script>
    import IssueBar from "./IssueBar";

    export default {
        name: "issue-list",
        components: {IssueBar},
        props: ['issues'],
        data() {
            return {}
        },
        methods: {
            selectIssue(issue) {
                this.$store.commit('selectIssue', issue);
                console.log(this.$store.getters.selectedIssue);
            }
        }
    }
</script>

<style scoped>

</style>
