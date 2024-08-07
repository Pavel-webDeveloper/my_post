<template>
    <main>
        <h1>Lista Piatti</h1>

        <ul>
            <li v-for="piatto in listaPost" :key="piatto.id">{{piatto.title}}
                <a href="#" @click="getDetail(piatto.slug)">Vedi</a>
                <span v-if="detailPost">{{detailPost.slug}}</span>
            </li>
        </ul>
    </main>
</template>

<script>
export default {
    name: "MainComponent",
    data(){
        return {
            listaPost: [],

            detailPost: null,
        }
    },
    methods: {
        getDetail(mySlug){
            axios.get('/api/posts/' + mySlug).then((res)=>{
                this.detailPost = res.data;
            })
        }
    },
    created(){
        axios.get('/api/posts').then((res)=>{
            // console.log(res.data);
            this.listaPost = res.data;
        })
    }
}
</script>

<style lang="scss">

</style>
