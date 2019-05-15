<template>
    <div class="card tab-card">

        <slot></slot>

    </div>
</template>

<script>
    Vue.component('tabs', require('./tabs.vue').default);
    Vue.component('panels', require('./panels.vue').default);
    export default {
        data() {
            return {
                active: false
            }
        },
        mounted() {
            
        }
    }
</script>
