<script lang="ts">
import {defineComponent} from "vue"
import Logo from "../icons/logo.vue"

export default defineComponent({
  name: "Header",
  components: {Logo},
})
</script>

<template>
  <header class="header">
    <div class="nav">
      <div class="nav-left">
        <router-link :to="`/`">
          <span class="nav-left-logo">
            <Logo />
          </span>
        </router-link>
      </div>
      <div class="nav-right">
        <div class="nav-right-auth">
          <a target="_blank" href="https://freelancehunt.com/ua/profile/login?to=/ua/projects">Вхід</a>

          <a target="_blank" href="https://freelancehunt.com/ua/profile/register" class="register">Реєстрація</a>
        </div>

      </div>
    </div>
  </header>
</template>

<style lang="scss">
.header {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: auto;
  display: flex;
  width: 100%;
  height: 117px;
  border-bottom: 1px solid hsla(0, 0%, 100%, .3);
  background-color: #fff;
  backdrop-filter: blur(8px);
  border-bottom: 0.5px solid #1f164699;
  z-index: 30;
  @media (max-width: 1024px) {
    height: 67px;
  }
}

.nav {
  position: relative;
  z-index: 10;
  display: flex;
  width: 100%;
  justify-content: space-between;
  grid-auto-columns: 1fr;
  grid-column-gap: 0;
  grid-row-gap: 0;
  grid-template-columns: 1fr 1fr 1fr;

  &-left {
    display: flex;
    a {
      left: -1px;
      top: 1px;
      display: flex;
      padding-right: 113px;
      padding-left: 112px;
      flex-direction: row;
      justify-content: flex-start;
      align-items: center;
      flex: 1;
      border-right: 0.5px solid hsl(250deg 50% 18% / 60%);
      transition: border-color 200ms ease,background-color 200ms ease;
      color: #fff;
      @media (max-width: 1024px) {
        padding-right: 16px;
        padding-left: 16px;
        border-right: none;
      }
    }
    &-logo {
      width: 316px;
      height: 78px;
      @media (max-width: 1024px) {
        width: auto;
        height: 40px;
        svg {
          height: 100%;
          object-fit: contain;
          width: 100%;
        }
      }
    }
  }
  &-right {
    display: flex;
    align-items: center;
    padding-right: 112px;
    padding-left: 103px;
    @media (max-width: 1024px) {
      padding-right: 16px;
      padding-left: 16px;

    }
    &-auth {
      display: flex;
      align-items: center;
      gap: 40px;
      @media (max-width: 1024px) {
        gap: 20px;
      }
      a {
        color: #121212;
      }
      .register {
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
        @media (max-width: 767px) {
          font-size: 11px;
          line-height: 15px;
          padding: 10px 14px;
        }
        &:hover {
          background-color: #ffbb17;
          color: #121212;
          cursor: pointer;
        }
      }
    }

  }


}
</style>
