<template>
    <div class="panels">
        <slot></slot>
    </div>
</template>

<script>
    Vue.component('panel', require('./panel.vue').default);
    export default {
        mounted() {
            
        }
    }
</script>
