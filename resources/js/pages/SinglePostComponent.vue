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
                <!-- <a href="#" class="card-link">Another link</a> -->
            </div>
        </div>

        <!-- form Commenti -->
        <div class="form-group mt-5">
            <h3>Inserisci un commento</h3>
            <form @submit.prevent="addComment()">
                <label for="username">Inserisci il nome</label>
                <input type="text" v-model="formData.username" class="form-control">

                <label for="content">Inserisci il messaggio</label>
                <input type="text" v-model="formData.content" class="form-control">

                <button type="submit" class="mt-3 btn btn-primary">Invia</button>
            </form>
        </div>


        <!-- Vista Commenti -->
        <div v-if="itemPost.comments.length > 0">
            <h3 class="mt-5">Commenti</h3>
            <ul>
                <li v-for="comment in itemPost.comments" :key="comment.id">{{comment.username}}
                    <ul>
                        <li style="list-style-type: none;">{{comment.content}}</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return {
            itemPost: null,
            descLim: true,
            formData: {
                "username": "",
                "content": "",
                "post_id": "",
            }
        }
    },
    methods: {
        descriptToogle(lim){
            if(lim == true){
                this.descLim = false;
                // console.log('falso');
            }else {
                this.descLim = true;
                // console.log('vero');
            }
        },
        addComment(){
            axios.post('/api/comments', this.formData).then((res)=>{
                // console.log(res.data);
                this.itemPost.comments.push(res.data);
            })
        }
    },
    mounted(){
        // console.log(this.$route.params);
        const itemSlug = this.$route.params.slug;

        axios.get(`/api/posts/${itemSlug}`).then((res)=>{
            this.itemPost = res.data;
            this.formData.post_id = this.itemPost.id;
            // console.log(this.itemPost);
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
