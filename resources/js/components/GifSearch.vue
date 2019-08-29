<template>
    <div>
        <div>

            <!-- Chosen GIF -->
            <div v-if="chosenGIF">
                <img :src="chosenGIF.images.fixed_height.url" />
                <input type="hidden" name="gif" :value="chosenGIF.images.fixed_height.url" />
            </div>
            <!-- -->

            <!-- Search -->
            <div>
                <form @submit.prevent="doSearch">
                    <input v-model="query" type="text" placeholder="GIF Search" class="form-control" />
                    <button type="submit" class="btn btn-primary">Go</button>
                </form>
            </div>
            <!-- -->

            <!-- Results -->
            <div v-show="showResults">
                <result
                    @chooseGIFEvent="chooseGIFHandler(index)"
                    v-for="(result, index) in results"
                    :image="result.images.fixed_height.url"
                    :key="index" />
            </div>
            <!-- -->


        </div>
    </div>
</template>

<script>
import axios from 'axios'
import Result from './Result.vue'

export default {
    name: 'GifSearch',
    components: { Result },
    data() {
        return {
            apiKey: 'gZnc927QbpNoIWxa53F9pXlrwGfWOxIm',
            query: '',
            results: [],
            chosenGIF: null,
            showResults: false
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
