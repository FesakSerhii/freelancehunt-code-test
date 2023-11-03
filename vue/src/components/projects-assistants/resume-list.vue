<script lang="ts">
import {defineComponent} from "vue"

export default defineComponent({
  name: "resume-list",
  props: {list: Array},
})
</script>

<template>
  <div class="projects-item" v-for="(res, index) in list" :key="index">
    <div class="projects-item-content">
      <router-link :to="`/projects/${res.id}`">
        <h2>{{ res.attributes.name }}</h2>
      </router-link>
      <div class="projects-item-content-info">
        <div class="projects-item-content__tag-wrap">
          <p class="projects-item-content__tag" v-for="(skill, i) in res.attributes.skills" :key="i">{{skill.name}}</p>
        </div>
        <p class="projects-item-content__price" v-if="res.attributes.budget">{{res.attributes.budget.amount}} {{res.attributes.budget.currency}}</p>
      </div>
    </div>
    <div class="projects-item-info">
      <router-link :to="`/projects/${res.id}`" class="primary-button">
        <span class="text-lg">Переглянути</span>
      </router-link>
    </div>
  </div>

</template>

<style lang="scss">
.projects-item {
  width: 100%;
  padding-top: 48px;
  padding-bottom: 48px;
  border-bottom: 1px solid #1f164633;
  display: flex;
  justify-content: space-between;
  @media (max-width: 767px) {
    flex-direction: column;
    gap: 50px;
  }

  &:first-child {
    border-top: 1px solid #1f164633;
  }
  &-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    h2 {
      font-size: 32px;
      line-height: 44px;
      color: #121212;
      transition: color .3s;
      &:hover {
        color: #ffbb17;
      }
    }
    &-info {
      display: flex;
      gap: 22px;
      align-items: center;
      @media (max-width: 767px) {
        flex-direction: column-reverse;
        align-items: flex-start;
        gap: 8px;
      }
    }
    &__tag {
      font-size: 16px;
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
      }
      &:first-child {
        &:before {
          display: none;
        }
      }
      &-wrap {
        display: flex;
        gap: 22px;
        align-items: center;
        @media (max-width: 767px) {
          flex-wrap: wrap;
        }
      }

    }

    &__price {
      color: #f3ac00;
      font-size: 18px;
      font-weight: 700;
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
      }
    }
  }
}

.projects-content {

}
.primary-button {
  background-color: #121212;
  border: none;
  color: #f5f5f5;
  font-weight: 500;
  letter-spacing: .06em;
  padding: 10px 20px;
  text-transform: uppercase;
  transition: background-color .3s;
  font-size: 13px;
  line-height: 20px;
  &:hover {
    background-color: #ffbb17;
    color: #121212;
    cursor: pointer;
  }
}
</style>
