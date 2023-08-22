<template>
    <span>
        {{ formattedDate }}
    </span>
</template>

<script>
export default {
    props: {
        date: {
            type: String,
            required: true
        }
    },
    computed: {
        formattedDate() {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(this.date).toLocaleDateString(undefined, options);
        }
    }
};
</script>
