<template>
    <div class="flex relative">
        <div
            class="img-wrapper top-0 left-0 sticky lg:h-screen overflow-hidden flex-shrink-1 flex-grow-0 lg:block hidden">
            <img class="img-auth h-full w-full" src="@/assets/image/register.png" />
        </div>
        <div class="flex-grow-1 md:flex-shrink-0 flex  flex-column align-items-center md:px-5 lg:px-8 px-4">
            <slot></slot>
        </div>
    </div>
</template>
<style scoped>
.img-auth {
    max-width: 900px;
    object-fit: cover;
    object-position: 0%;
    filter: brightness(60%);
}
</style>