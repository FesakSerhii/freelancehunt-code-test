<script lang="ts">
import {defineComponent} from "vue"
import {Projects} from "../../models/projects";
import {useStore} from "@/stores/userStore";
import moment from "moment";

export default defineComponent({
  name: "ProjectsView",
  computed: {
    moment() {
      return moment
    }
  },
  setup() {
    const projectsStore = useStore();
    return {projectsStore}
  },
  data() {
    return {
      project: null,
    }
  },
  async mounted() {
    const params = this.$route.params;
    await this.$api.get(`projects/${params.id}`).then((resp: { data?: Projects }) => {
      this.project = resp?.data
    });
  },
  methods: {
    dateTime(value) {
      return moment(value).format('DD.MM.YYYY HH:ss');
    },
  },
})
</script>

<template>
  <main>
    <div class="project" v-if="project">
      <div class="project__hero">
        <div class="project__hero_top">
          <router-link :to="`/`" class="label" >
            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M7.09773 1L1 7M1 7L7.09773 13M1 7H20" stroke="#121212" stroke-width="1.4"></path>
            </svg>
            Всі проєкти
          </router-link>
          <date>{{ dateTime(project?.attributes?.expired_at) }}</date>
        </div>

        <div class="top">
          <h1 class="title">{{project?.attributes?.name || ''}}</h1>
          <div class="price" v-if="project?.attributes.budget">{{project.attributes?.budget.amount}} {{project.attributes.budget.currency}}</div>
        </div>

        <a :href="project?.links?.self?.web" target="_blank" class="primary-button">
          Виконати проєкт
        </a>

        <div class="project__hero-info" v-if="project.attributes?.skills && project.attributes.skills.length">
          <div class="label" v-for="(skill, i) in project?.attributes?.skills" :key="i">{{skill.name}}</div>
        </div>
      </div>
      <div class="project__content" v-html="project?.attributes?.description_html">
      </div>

    </div>
  </main>
</template>

<style scoped lang="scss">
.project {
  margin-bottom: 60px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  @media (max-width: 1024px) {

  }
  &__hero {
    padding: 85px 0 0;
    position: relative;
    @media (max-width: 1024px) {
      padding: 0 16px 0;
    }
    @media (max-width: 767px) {
      padding: 0
    }
    &_top {
      display: flex;
      justify-content: space-between;
    }
    a.label {
      margin-bottom: 30px;
      align-items: center;
      color: #121212;
      display: flex;
      font-weight: 500;
      letter-spacing: .06em;
      font-size: 13px;
      line-height: 20px;
      text-transform: uppercase;
      @media (max-width: 1024px) {

      }
      svg {
        margin-right: 16px;
      }
    }
    &-info {
      left: 60px;
      padding-top: 60px;
      display: flex;
      gap: 20px;
      @media (max-width: 767px) {
        flex-wrap: wrap;
      }
      .label {
        position: relative;
        display: flex;
        align-items: center;
        &:before {
          content: '';
          position: absolute;
          left: -11px;
          height: 20px;
          background-color: rgba(31, 22, 70, 0.7);
          opacity: .3;
          width: 1px;
          @media (max-width: 767px) {
            display: none;
          }
        }
        &:first-child {
          &:before {
            display: none;
          }
        }
      }
    }
  }
  .top {
    margin-bottom: 160px;
    @media (max-width: 1024px) {
      margin-bottom: 80px;
    }
    .price {
      font-size: 40px;
      color: #f3ac00;
      @media (max-width: 1024px) {
        font-size: 28px;
      }
    }
  }
  h1.title {
    font-size: 110px;
    line-height: 1;
    letter-spacing: -.03em;
    font-weight: 400;
    max-width: 1062px;
    margin-bottom: 25px;
    @media (max-width: 1024px) {
      font-size: 60px;
    }
  }
  a.primary-button {
    background-color: #f3ac00;
    border: none;
    color: #121212;
    font-family: Azeret,Arial,sans-serif;
    font-weight: 500;
    letter-spacing: .06em;
    padding: 10px 20px;
    text-transform: uppercase;
    transition: background-color .3s;
    font-size: 13px;
    line-height: 20px;
    &:hover {
      background-color: #121212;
      color: #f3ac00;
      cursor: pointer;
    }
  }
  &__content {
    margin-bottom: 144px;
    margin-left: 540px;
    width: 658px;
    padding: 60px 0 0;
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    hyphens: auto;
    overflow: hidden;
    @media (max-width: 1024px) {
      margin-left: 0;
      width: 100%;
    }
    h2 {
      font-size: 32px;
      line-height: 44px;
      font-weight: 500;
      letter-spacing: -.01em;
      &:first-of-type {
        margin-top: 0;
      }
    }
    p {
      color: hsla(0,0%,7%,.6);
      margin-bottom: 10px;
    }
    ul li {
      list-style-type: disc;
    }
  }

}
</style>
