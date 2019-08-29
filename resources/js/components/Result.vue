<template>
    <div class="list-group-item">
        <img :src="image" @click="chooseGIF" />
    </div>
</template>

<script>
export default {
    props: ['image'],
    methods: {
        chooseGIF() {
            this.$emit('chooseGIFEvent')
        }
    }
}
</script>
