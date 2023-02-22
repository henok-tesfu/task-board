<template>
    <div>
        <h1>{{project.title}}</h1>
        <h1>{{project.description}}</h1>
    </div>
</template>

<script>
export default {
    props:['project']
}
</script>