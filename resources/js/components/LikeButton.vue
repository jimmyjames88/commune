<template>
    <a href="#" @click="doLike">
        <i class="fa fa-thumbs-up"></i> {{ dataIsLiked ? 'Unlike' : 'Like' }} ({{ dataCount }})
    </a>
</template>

<script>
    export default {
        props: [ 'count', 'postId', 'isLiked' ],

        data() {
            return {
                dataCount: 0,
                dataIsLiked: false,
            }
        },

        mounted() {
            this.dataCount = this.count;
            this.dataIsLiked = this.isLiked;
        },

        methods: {
            doLike(e) {

                e.preventDefault();

                if(this.dataIsLiked) {
                    var url = '/posts/' + this.postId + '/unlike';
                } else {
                    var url = '/posts/' + this.postId + '/like';
                }

                // ajax request to the unlike route
                axios.post(url)
                    .then( (response) => {

                        if(response.data.status == 'success') {

                            if(this.dataIsLiked) {
                                // did unlike
                                this.dataCount--;
                                this.dataIsLiked = false;
                            } else {
                                // did like
                                this.dataCount++;
                                this.dataIsLiked = true;
                            }

                        } else {
                            // if fails
                        }

                    })

            }
        }
    }
</script>

<style>

</style>
