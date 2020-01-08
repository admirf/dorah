<template>
    <kanban-board :stages="stages" :blocks="blocks">
        <div v-for="block in blocks" :slot="block.id" :key="block.id">
            <div>
                <strong>id:</strong> {{ block.id }}
            </div>
            <div>
                {{ block.title }}
            </div>
        </div>
    </kanban-board>
</template>

<script>
  export default {
    name: "sprint",
    props: ['issues'],
    data() {
      return {
        stages: ['to-do', 'in-progress', 'feedback', 'done'],
        blocks: [
          {
            id: 1,
            status: 'to-do',
            title: 'Test',
          },
        ]
      }
    },
    created() {
      console.log(this.issues);
    }
  }
</script>

<style lang="scss">
    @import '~vue-kanban/src/assets/kanban';
</style>