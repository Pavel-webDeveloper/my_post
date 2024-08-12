<template>
    <div>
        <h1>Posts</h1>

        <ul v-if="posts.length > 0" >
            <li v-for="post in posts" :key="post.id" class="my-3">
                {{post.title}}
                <router-link
                :to="{ name: 'single-post', params: {slug: post.slug}}" class="btn btn-primary" style="color: white">Visualizza</router-link>
            </li>

        </ul>
    </div>
</template>

<script>
export default {
    name: 'PostsComponent',
    data(){
        return {
            posts: [],
        }
    },
    created(){
        axios.get('/api/posts').then((res)=>{
            this.posts = res.data;
        })
    }
}
</script>

<style lang="scss">
.router-link-exact-active {
    color: #fff !important;
}

</style>
