<template>
    <form @submit.prevent="login">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="email" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" />
        </div>
        <button type="submit">Login</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            errors: [],
        };
    },
    methods: {
        login() {
            axios
                .post("/login", {
                    email: this.email,
                    password: this.password,
                })
                .then((response) => {
                    console.log(response.data);
                    // Menyimpan user id ke local storage
                    localStorage.setItem("user_id", response.data.id);
                })
                .catch((error) => {
                    console.log(error.response.data.errors);
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
