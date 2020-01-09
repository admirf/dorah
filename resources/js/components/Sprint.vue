<template>
    <kanban-board :stages="stages" :blocks="blocks" @update-block="updateBlock">
        <div class="block" v-for="block in blocks" :slot="block.id" :key="block.id" @click="selectIssue(block)">
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
  import axios from 'axios'

  export default {
    name: "sprint",
    props: ['issues'],
    data() {
      return {
        stages: ['todo', 'in-progress', 'feedback', 'done'],
        blocks: []
      }
    },
    created() {
      this.issues.forEach(item => {
        this.blocks.push({
          title: item.text,
          ...item
        })
      })
    },
    methods: {
      selectIssue(issue) {
        this.$store.commit('selectIssue', issue);
      },

      updateBlock(id, status) {
        axios.put(`/api/issues/${id}`, {
          'status': status
        })
      }
    }
  }
</script>

<style lang="scss">
    @import '~vue-kanban/src/assets/kanban';

    .block {
        cursor: pointer;
    }

    .drag-column-todo {
        margin-left: 0;
    }

    .drag-column-in-progress {
        background-color: #38c172;
    }

    .drag-column-feedback {
        background-color: #3490dc;
    }

    .drag-column-done {
        background-color: #563d7c;
        margin-right: 0;

        h2 {
            color: white;
        }
    }
</style>