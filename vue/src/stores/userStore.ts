import { defineStore } from 'pinia'

interface Store {
  projectsList: null;
}
export const useStore = defineStore('main', {
  state: (): Store => ({
    projectsList: null
  }),
  actions: {
    async projectsAll() {
      this.projectsList = await this.api.get("projects");
    },
  }
})
