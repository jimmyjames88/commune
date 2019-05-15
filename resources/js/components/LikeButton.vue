<template>
    <a href="#" @click.prevent="doLike" :class="{ 'font-weight-bold' : isLiked }">
        <i class="fa fa-thumbs-up"></i> {{ ( isLiked ? 'Unlike' : 'Like') }} ({{ likeCount }})
    </a>
</template>

<script>
export default {
    props: ['id', 'liked', 'type', 'count'],
    data() {
        return {
            isLiked: false,
            likeCount: 0
        }
    },
    methods: {
        doLike() {

            axios.get('/likes/' + this.id + '/' + this.type)
                .then((response) => {
                    if(response.data.status == 'success') {
                        // update isLiked
                        this.isLiked = !this.isLiked;

                        // update the likeCount
                        if(this.isLiked) {
                            this.likeCount++;
                        } else {
                            this.likeCount--;
                        }

                    }
                })
        }
    },
    mounted() {
        this.isLiked = this.liked;
        this.likeCount = this.count;
    }
}
</script>

<style>

</style>
