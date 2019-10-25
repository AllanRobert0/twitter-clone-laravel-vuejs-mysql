<template>
  <div class="topo">
    <div class="container w-clearfix">
      <div class="div-azul"></div>
      <div class="div-formulario">
        <div class="div-entrar">
          <div class="w-form">
            <form id="email-form" name="email-form" data-name="Email Form" class="w-clearfix">
              <div class="div-text-field w-clearfix">
                <input
                  v-model="login.email"
                  type="text"
                  maxlength="256"
                  placeholder="E-MAIL"
                  class="text-field-entrar margem-right w-input"
                />
                <input
                  v-model="login.senha"
                  type="password"
                  maxlength="256"
                  placeholder="SENHA"
                  class="text-field-entrar w-input"
                />
                <a href="#" class="link-esqueceu-sua-senha">Esqueceu sua senha?</a>
              </div>
              <input
                @click="entrar"
                value="ENTRAR"
                data-wait="Please wait..."
                class="botao-entrar w-button"
              />
            </form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
        </div>
        <div class="div-cadastrar">
          <p class="cadastre-se">cadastre-se</p>
          <div class="w-form">
            <form id="email-form-2" name="email-form-2" data-name="Email Form 2">
              <input
                v-model="cadastro.nome"
                type="text"
                class="text-field-cadastrar w-input"
                maxlength="256"
                name="name"
                data-name="Name"
                placeholder="NOME"
                id="name"
              />
              <input
                v-model="cadastro.email"
                type="text"
                class="text-field-cadastrar w-input"
                maxlength="256"
                name="name-2"
                data-name="Name 2"
                placeholder="E-MAIL"
                id="name-2"
              />
              <input
                v-model="cadastro.senha"
                type="password"
                class="text-field-cadastrar w-input"
                maxlength="256"
                name="name-3"
                data-name="Name 3"
                placeholder="SENHA"
              />
              <input
                v-model="confirma_senha"
                type="password"
                class="text-field-cadastrar w-input"
                maxlength="256"
                name="name-3"
                data-name="Name 3"
                placeholder="CONFIRMAR SENHA"
              />
              <input
                @click="cadastrar"
                value="CADASTRAR"
                data-wait="Please wait..."
                class="botao-cadastrar w-button"
              />
            </form>
            <div class="w-form-done">
              <div>Thank you! Your submission has been received!</div>
            </div>
            <div class="w-form-fail">
              <div>Oops! Something went wrong while submitting the form.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
@import "./css/desafio.webflow.css";
@import "./css/normalize.css";
@import "./css/webflow.css";
</style>

<script>
export default {
  data: () => ({
    login: {
      email: "",
      senha: ""
    },

    cadastro: {
      nome: "",
      email: "",
      senha: ""
    },
    confirma_senha: ""
  }),
  methods: {
    entrar() {
      fetch("/api/entrar", {
        method: "post",
        body: JSON.stringify(this.login),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(JSON.stringify(data));
          localStorage.setItem("auth_token", JSON.stringify(data.token[0]));
          localStorage.setItem("usuario_id", JSON.stringify(data.token[1]));
          localStorage.setItem("usuario_nome", JSON.stringify(data.token[2]));

          if (!data.token) throw "Failed Login";
          location.replace("/feed");
        })
        .catch(error => console.log(error));
    },
    cadastrar() {
      //verifica se senha e confirma senha sao iguais
      if (this.cadastro.senha != this.confirma_senha)
        alert("As senhas devem ser Iguais");
      else
        fetch("/api/cadastrar", {
          method: "post",
          body: JSON.stringify(this.cadastro),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            alert(JSON.stringify(data));
            Object.assign(this.$data, this.$options.data());
          })
          .catch(error => console.log(error));
    }
  }
};
</script>