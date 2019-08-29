<template>
    <form class="form-inline" :action="'/posts/' + postid + '/comments'" method="POST" enctype="multipart/form-data">
        {{ csrf }}
        <div class="form-group col-2">
            <slot></slot>
        </div>
        <div class="form-group col-8">
            <input v-if="!showGIFs" type="text" name="body" class="form-control w-100" placeholder="Write a comment" />
            <button class="btn btn-sm btn-primary" @click="showGIFs = !showGIFs">GIF</button>
            <gif-search v-if="showGIFs" />
        </div>
        <div class="form-group col-2">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import Result from './Result.vue'

export default {
    name: 'GifSearch',
    components: { Result },
    props: ['postid', 'csrf'],
    data() {
        return {
            apiKey: 'gZnc927QbpNoIWxa53F9pXlrwGfWOxIm',
            query: '',
            results: [],
            chosenGIF: null,
            showResults: false,
            showGIFs: false
        }
    },

    methods: {
        doSearch() {
            axios.get('https://api.giphy.com/v1/gifs/search?api_key=' + this.apiKey + '&q=' + this.query)
                .then( (response) => {
                    this.results = response.data.data;
                    this.showResults = true;
                })
        },

        chooseGIFHandler(target) {
            this.chosenGIF = this.results[target];
            this.showResults = false;
        }
    }

}
</script>

<style lang="scss">

</style>
