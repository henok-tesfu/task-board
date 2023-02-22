<template>
    <div class="h-screen w-screen bg-yellow-200">
            <h1 class="text-[50px] text-center font-[700]">TaskBoard</h1>


        <ul v-if="projects.length" class="w-[400px] bg-red-500"> 
            <li v-for="(project,index) in projects" :key="index" class="w-full bg-green-300 my-3"> 
                <Link :href="'/projects/'+project.id">{{project.title}}</Link>
               
            </li>
        </ul>
        <ul v-else><li>
            Empty
        </li> </ul>


    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
export default {
    props : ['projects'],
    components: {
    Link,
  },
}
</script>