<template>
    <div>
        <div class="w-full px-3 mt-3">
            <codemirror v-model="recipe.body" :options="cmConfig"></codemirror>
        </div>
    </div>
</template>
<script>
import { codemirror } from 'vue-codemirror'

import 'codemirror/mode/shell/shell.js'

import 'codemirror/lib/codemirror.css'
import 'codemirror/theme/monokai.css'

export default {
    props: {
        recipe: Object
    },
    data() {
        return {
            cmConfig: {
                theme: 'monokai',
                lineNumbers: true,
                mode: 'shell',
                readOnly: true
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
