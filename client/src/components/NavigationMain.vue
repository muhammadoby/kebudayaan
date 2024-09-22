<script lang="ts" setup>
import { ref, onMounted, nextTick } from 'vue';
import { type ComponentExposed } from 'vue-component-type-helpers'
import { navMainStore } from '@/stores/navMain';
import type NavigationMobile from './NavigationMobile.vue';

const state = navMainStore();
const nav = ref<HTMLElement>();
const navMobile = ref<ComponentExposed<typeof NavigationMobile>>();

onMounted(async () => {
    await nextTick();
    state.height = nav.value?.clientHeight || 0;

});



</script>
<template>
    <nav class="fixed nav w-full" ref="nav" v-show="!state.hide" :style="{ '--nav-height': `${state.height}px` }">
        <div class="navbar-nav  w-full gap-4 align-items-center">
            <div class="logo">
                <img src="@/assets/image/logo.png" />
            </div>
            <div class=" gap-4 nav-link lg:flex hidden">
                <div>
                    <RouterLink to="/" class="router-link" :class="{ 'active': state.active == 'home' }">
                        Home
                    </RouterLink>
                </div>
                <div>
                    <RouterLink to="/culture" class="router-link" :class="{ 'active': state.active == 'culture' }">
                        budaya
                    </RouterLink>
                </div>
                <div>
                    <RouterLink to="/event" class="router-link" :class="{ 'active': state.active == 'event' }">Acara
                    </RouterLink>
                </div>
                <div>
                    <RouterLink to="/contact" class="router-link" :class="{ 'active': state.active == 'contact' }">
                        Contact
                    </RouterLink>
                </div>
            </div>
            <div class="justify-content-end w-full flex gap-4 align-items-center lg:flex hidden">
                <div class="lg:hidden" @click="navMobile?.toggleActive(true)">
                    <i class="bi bi-list text-3xl"></i>
                </div>
            </div>

        </div>
    </nav>
    <NavigationMobile ref="navMobile" />

</template>
<style scoped>
.text-gray {
    color: rgb(95, 99, 104);
}

.logo {}

.logo>img {
    background-color: black;
    border-radius: 50%;
    width: 40px;
    aspect-ratio: 1/1;
}

.nav {
    z-index: 25;
    background-color: white;
}

.navbar-nav {
    display: flex;
    z-index: 50;
    font-size: 1.1rem;
    align-items: center;
    padding: 12px 28px;
    font-weight: 500;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

.search {
    max-width: 265px;
    width: 100%;
    font-size: 1.15rem;
}

.search-input {
    width: 100%;
    border-radius: 5px;
    padding: 6px 10px;
    padding-left: 40px;
    border: solid 1px #F2F2F2;
    background-color: #F2F2F2;
    outline: none;
}

.search-icon {
    padding-inline: 10px;
    transform: translateY(-50%);
    top: 50%;
    left: 0;
    position: absolute;
}

.router-link {
    position: relative;
    padding-bottom: 2px;
    text-decoration: none;
}

.router-link.active {
    color: #00A3FF
}

.router-link:hover {
    color: #2f8dc1;
}

.nav-register {
    border-radius: 8px;
    padding: 8px 13px;
    color: white;
    background-color: #00A3FF;
}

.profile-pic {
    width: 40px;
    border-radius: 50%;
    aspect-ratio: 1/1;
    background-color: black;
}

.profile-dropdown {
    display: flex;
    flex-direction: column;
    background-color: white;
    max-width: 150px;
    width: max-content;
    top: 0;
    padding-block: 5px;
    font-size: 1rem;
    font-weight: 400;
    position: absolute;
    border-radius: 8px;
    transform: translate(-55%, 55px);
}

.profile-dropdown div {
    padding: 5px 20px 5px;
}

.profile-dropdown :hover {
    background-color: #F2F2F2;
}
</style>