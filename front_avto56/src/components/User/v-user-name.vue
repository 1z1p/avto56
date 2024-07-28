<template>
    <div class="v-user">
        <p>{{ user }}: {{ name }}</p>
    </div>
</template>

<script lang="ts">
export default {
    props: {
        user: String,
        name: String
    }
}
</script>