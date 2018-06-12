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
            <textarea name="recipe-body" id="recipe-body" rows="10" class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4 leading-tight" v-model="recipe.body"></textarea>
        </div>
        <div class="mt-3 text-center">
            <button class="bg-orange px-4 py-2 rounded" @click="create">Create</button>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            recipe: {
                title: null,
                body: null
            }
        }
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
