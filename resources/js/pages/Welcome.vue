<script setup>
const newFunction = () => {
    const res = confirm("Alerta activada",);
    if (!res) return;
    window.open('https://midu.dev')
};

</script>

<template>
    <button @click="newFunction"
        class="px-4 py-2 m-4 text-sm cursor-pointer active:bg-neutral-800 text-neutral-100 bg-neutral-900 rounded-xl w-max">
        Activar alerta
    </button>
</template>