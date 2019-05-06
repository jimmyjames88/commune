<template>
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <slot></slot>
        </ul>
    </div>
</template>
<script>
    Vue.component('tab', require('./tab.vue').default);
    export default {

    }
</script>
