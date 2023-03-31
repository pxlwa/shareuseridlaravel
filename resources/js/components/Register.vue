<template>
    <form @submit.prevent="register">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" v-model="name" />
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="email" />
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" />
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input
                type="password"
                id="password_confirmation"
                v-model="password_confirmation"
            />
        </div>
        <button type="submit">Register</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            errors: [],
        };
    },
    methods: {
        register() {
            axios
                .post("/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
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
