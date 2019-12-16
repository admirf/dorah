<template>
    <li class="list-group-item">
        {{ issue.text }}
    </li>
</template>

<script>
    export default {
        name: "issue-bar",
        props: ['issue']
    }
</script>

<style scoped>

</style>
