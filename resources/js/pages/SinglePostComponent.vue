<template>
    <div v-if="itemPost">
        <div class="card" style="width: 18rem;">
            <img :src="itemPost.image" class="card-img-top" alt="..." style="max-height: 400px; object-fit: contain;">
            <div class="card-body">
                <h5 class="card-title">{{itemPost.title}}</h5>
                <p class="card-text" v-if="descLim">{{itemPost.description.slice(0, 250)}} <span id="altro" @click="descriptToogle(descLim)">...</span></p>
                <p class="card-text" v-if="descLim == false">{{itemPost.description}}</p>
                <p v-if="descLim == false" style="color: lightblue; cursor: pointer;" @click="descriptToogle(descLim)">^- mostra meno</p>
            </div>
            <ul class="list-group list-group-flush">
                <li v-for="tag in itemPost.tags" :key="tag.id" class="list-group-item">{{tag.name}}</li>
            </ul>
            <div class="card-body">
                <a href="#" class="card-link">{{itemPost.category.name}}</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
    <div v-else>
        <h1></h1>
    </div>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return {
            itemPost: null,
            descLim: true,
        }
    },
    methods: {
        descriptToogle(lim){
            if(lim == true){
                this.descLim = false;
                console.log('falso');
            }else {
                this.descLim = true;
                console.log('vero');
            }
        }
    },
    mounted(){
        // console.log(this.$route.params);
        const itemSlug = this.$route.params.slug;

        axios.get(`/api/posts/${itemSlug}`).then((res)=>{
            this.itemPost = res.data;
            console.log(this.itemPost);
        }).catch((error)=>{
            this.$router.push({name: 'page-404'});
        })
    }
}
</script>

<style lang="scss">

    #altro {
        cursor: pointer;
    }
</style>
