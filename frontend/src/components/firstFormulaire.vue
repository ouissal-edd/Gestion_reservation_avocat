<template>
  <form @submit.prevent="handleSubmit">
    <label>nom:</label>
    <input type="text" required v-model="nom" />

    <label>prenom:</label>
    <input type="text" required v-model="prenom" />

    <label>age:</label>
    <input type="number" required v-model="age" />

    <label>CIN</label>
    <input type="text" required v-model="cin" />

    <label>profession:</label>
    <input type="text" required v-model="profession" />

    <div class="submit">
      <button type="submit">Envoyer</button>
    </div>
    <p>
      vous avez deja un compte?
      <router-link class="bt" to="/firstFormulaire">Ckliquez-ici</router-link>
    </p>
  </form>
</template>


<script>
export default {
  name: "firstFormulaire",
  data() {
    return {
      nom: "",
      prenom: "",
      age: "",
      cin: "",
      profession: "",
    };
  },
  methods: {
    async handleSubmit() {
      const data = {
        nom: this.nom,
        prenom: this.prenom,
        age: this.age,
        cin: this.cin,
        profession: this.profession,
      };

      fetch("http://localhost/Backend%20RDV/API/users/insertUser", {
        method: "POST",
        header: "Content-type: application/json",
        body: JSON.stringify(data),
      })
        .then((reponseBis) => reponseBis.json())
        .then(function (dataBis) {
          console.log(dataBis.ref);
          // sessionStorage.setItem("reference", dataBis.ref);
          // console.log(sessionStorage.getItem("reference"));
          alert("Your Reference is: " + dataBis.ref);
        });
    },
  },
};
</script>

<style>
form {
  max-width: 420px;
  margin: 20px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: rgb(12, 12, 12);
  display: inline-block;
  margin: 25px 0 15px;
  font-size: 0.6em;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input {
  display: block;
  padding: 10px 6px;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 2px solid #cea368;
  color: #555;
  outline: none;
}
button {
  background: linear-gradient(45deg, black, #cea368);
  border: none;
  padding: 11px 90px;
  margin-top: 20px;
  margin-left: 20px;
  color: white;
  border-radius: 20px;
}
p {
  margin-top: 30px;
}
p .bt {
  text-decoration: none;
  color: #cea368;
}
.submit {
  text-align: center;
}
</style>