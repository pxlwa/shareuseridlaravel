<template>
    <div>
        <div class="mt-4">
            <label for="share-id" class="block font-medium text-gray-700"
                >Share ID:</label
            >
            <input
                type="text"
                id="share-id"
                v-model="shareId"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            />
        </div>

        <div class="mt-4">
            <button
                type="button"
                @click="createShareId"
                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-50 transition"
            >
                Create Share ID
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            shareId: "",
        };
    },
    methods: {
        createShareId() {
            axios
                .post("/share-id")
                .then((response) => {
                    this.shareId = response.data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
};
</script>
