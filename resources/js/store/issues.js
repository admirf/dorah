export default {
    state: {
        selectedIssue: null
    },
    getters: {
        selectedIssue: state => state.selectedIssue
    },
    actions: {},
    mutations: {
        selectIssue: (state, issue) => state.selectedIssue = issue
    }
}
