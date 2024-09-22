<script setup lang="ts">
import { ref } from 'vue';
const isActive = ref(false);
const toggleActive = (force?: boolean) => {
    isActive.value = force ?? !isActive.value;
    return force;
}

defineExpose({
    isActive,
    toggleActive
});
</script>
<template>
    <div class="backdrop flex justify-content-end" v-if="isActive" @click="toggleActive(false)">
        <div class="nav">
            <div class="flex  flex-column align-items-center">
                <div class="w-full px-3 flex justify-content-end py-2">
                    <i class="bi bi-x-lg text-2xl" @click="toggleActive(false)"></i>
                </div>
                <img class="profile-pic mt-3" src="@/assets/image/logo2.png" />
                <div class="font-semibold text-2xl mt-2">Explore budaya</div>
            </div>
            <div class="nav-menu mt-4 pt-2 text-lg font-medium">
                <RouterLink to="/" class="nav-menu-item">
                    <div class="gap-3 flex align-items-center  px-4 ">
                        <i class="bi bi-house text-xl"></i>
                        Home
                    </div>
                </RouterLink>

                <RouterLink to="/culture" class="nav-menu-item">
                    <div class="gap-3 flex align-items-center  px-4 ">
                        <i class="bi bi-people text-xl"></i>
                        Budaya
                    </div>
                </RouterLink>

                <RouterLink to="/event" class="nav-menu-item">
                    <div class="gap-3 flex align-items-center  px-4 ">
                        <img src="@/assets/image/icon/confetti.svg" width="17" />
                        Acara
                    </div>
                </RouterLink>

                <RouterLink to="/contact" class="nav-menu-item ">
                    <div class="gap-3 flex align-items-center  px-4 ">
                        <i class="bi bi-chat-dots"></i>
                        Contact
                    </div>
                </RouterLink>

            </div>


        </div>
    </div>
</template>
<style scoped>
.nav-menu {
    border-top: 2px solid #E2E8F0;
}

.profile-pic {
    width: 110px;
    border-radius: 50%;
    aspect-ratio: 1/1;
}

.nav {
    height: 100%;
    width: 100%;
    max-width: 400px;
    background-color: white;
}

.backdrop {
    position: relative;
    height: 100vh;
    width: 100%;
    z-index: 99;
    position: fixed;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7));
}

.nav-menu-item {
    display: block;
    padding-block: 10px;
}

.nav-menu-item:hover {
    background-color: rgba(255, 242, 242, 0.933);
}
</style>