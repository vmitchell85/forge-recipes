<template>
    <div>
        <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="recipe-title">
                Recipe Title
            </label>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight" id="recipe-title" type="text" placeholder="My new recipe" v-model="recipe.title">
        </div>
        <div class="w-full px-3 mt-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="recipe-body">
                Recipe Body
            </label>
            <codemirror v-model="recipe.body" :options="cmConfig"></codemirror>
        </div>
        <div class="mt-3 text-center">
            <button class="bg-orange px-4 py-2 rounded" @click="create">Create</button>
        </div>
    </div>
</template>
<script>
import { codemirror } from 'vue-codemirror'

import 'codemirror/mode/shell/shell.js'

import 'codemirror/lib/codemirror.css'
import 'codemirror/theme/monokai.css'

export default {
    data() {
        return {
            recipe: {
                title: null,
                body: null
            },
            cmConfig: {
                theme: 'monokai',
                lineNumbers: true,
                mode: 'shell'
            }
        }
    },
    components: {
        codemirror
    },
    methods: {
        create() {
            axios.post('/api/recipes', this.recipe)
                .then(response => {
                    top.location.href = "/recipes/" + response.data.id;
                })
                .catch(error => {
                    // TODO
                })
        }
    }
}
</script>
