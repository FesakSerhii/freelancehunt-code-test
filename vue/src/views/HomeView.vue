<template>
  <main>
    <div class="title">
      <div class="label"><h1>Фриланс-проєкти</h1></div>

      <a class="see label" target="_blank" href="https://freelancehunt.com/ua/projects">Переглянути всі
        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 8.00004H13V4H17V8L21 8.00004V12.0002L17 12V16H13V12L0 12.0002V8.00004Z"
                fill="currentColor"></path>
          <path d="M13 0V4H9V0H13Z" fill="currentColor"></path>
          <path d="M9 15.9999L13 16L12.9998 19.9999L9 20V15.9999Z" fill="currentColor"></path>
        </svg>
      </a>
    </div>
    <div class="profile-list">
      <ResumeList :list="list"></ResumeList>
    </div>

  </main>
</template>

<script lang="ts">
import {useStore} from "../stores/userStore";
import {defineComponent} from "vue";
import {Projects} from "../../models/projects";
import ResumeList from "../components/projects-assistants/resume-list.vue"

export default defineComponent({
  components: {ResumeList},
  setup() {
    const projectsStore = useStore();

    return {projectsStore}
  },
  data() {
    return {
      list: <Projects[]>[],
    }
  },
  async mounted() {
    await this.$api.get("projects").then((resp: { data?: Projects }) => {
      this.list = resp?.data
    });

  }
})
</script>
<style lang="scss">
main {
  width: 100%;
}
.title {

  width: 100%;
  align-items: center;
  display: flex;
  justify-content: space-between;
  margin-bottom: 85px;
  @media (max-width: 767px) {
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 45px;
  }
  h1 {
    font-size: 24px;
    font-weight: 400;
  }
}

div.label {
  font-family: Azeret,Arial,sans-serif;
  font-weight: 500;
  letter-spacing: .06em;
  text-transform: uppercase;
  font-size: 13px;
  line-height: 20px;
}
.see {
  align-items: center;
  color: #121212;
  cursor: pointer;
  display: flex;
  font-weight: 500;
  justify-content: center;
  letter-spacing: .06em;;
  text-transform: uppercase;
  font-size: 13px;
  line-height: 20px;
}
.see svg {
  margin-left: 20px;
}
</style>
