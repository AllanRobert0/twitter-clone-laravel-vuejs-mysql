<template>
  <div class="topo-publicacoes w-clearfix">
    <div class="div-perfil">
      <p class="nome-perfil">{{usuario_nome}}</p>
      <!-- <a href="" class="botao-seguir w-inline-block">
        <p class="seguir">seguir</p>
      </a>-->
      <button @click="sair" class="botao-seguir w-inline-block seguir">Sair</button>
    </div>
    <div class="div-feed">
      <div class="container-publicacoes">
        <div class="bloco-publicacao">
          <div class="w-form">
            <form id="email-form" name="email-form" data-name="Email Form">
              <textarea
                v-model="publicacao.texto_tweet"
                placeholder="Texto da Publicação"
                maxlength="5000"
                id="field"
                name="field"
                class="texto-publicar w-input"
              ></textarea>
              <input
                @click="publicar"
                value="Publicar"
                data-wait="Please wait..."
                class="botao-publicar w-button"
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

        <p class="feed">Feed</p>
        <div
          class="div-publicacao-feed"
          v-for="(tweet, publicacao_index) in tweets"
          :key="publicacao_index"
        >
          <h3>{{"Tweet"}}</h3>
          <p class="texto-publicacao">{{tweet.texto_tweet}}</p>
          <div
            class="div-comentario-existente"
            v-for="(comentario, index) in tweet.comentarios"
            :key="index"
          >
            <p class="nome-perfil-comentario">
              {{comentario.nome}}
              <button
                v-if="comentario.usuario_id != publicacao.usuario_id"
                @click="seguir(comentario.usuario_id)"
                class="botao-seguir w-inline-block"
              >SEGUIR</button>
            </p>
            <p class="comentario">{{comentario.texto_comentario}}</p>
          </div>
          <div class="w-form">
            <form id="email-form-2" name="email-form-2" data-name="Email Form 2" class="w-clearfix">
              <textarea
                v-model="texto_comentario"
                placeholder="..."
                maxlength="5000"
                id="field-2"
                name="field-2"
                class="textarea w-input"
              ></textarea>
              <input
                @click="comentar(tweet.id, publicacao_index)"
                value="Comentar"
                data-wait="Please wait..."
                class="submit-button w-button"
              />
            </form>
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
    tweets: [],
    comentarios: [],
    publicacao: {
      usuario_id: "",
      texto_tweet: ""
    },
    texto_comentario: "",
    usuario_nome: "",
    auth_token: ""
  }),
  methods: {
    seguir(usuario_seguido_id) {
      //segue um usuario
      fetch("/api/seguir", {
        method: "post",
        body: JSON.stringify({
          usuario_seguido_id: usuario_seguido_id,
          usuario_id: this.publicacao.usuario_id
        }),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(JSON.stringify(data));
        })
        .catch(error => console.log(error));

      //recarrega feed apos seguir novo usuario
      this.carregarFeed();
    },

    sair() {
      //encerra sessao
      localStorage.clear();
      location.replace("/");
    },

    publicar() {
      //publica um tweet e add localmente
      fetch("/api/salvartweet", {
        method: "post",
        body: JSON.stringify(this.publicacao),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          this.tweets.unshift({
            comentarios: [],
            id: data.tweet_id,
            usuario_id: data.usuario_id,
            texto_tweet: data.texto_tweet
          });
          console.log("Publicacao Adicionada");
          this.publicacao.texto_tweet = "";
        })
        .catch(error => console.log(error));
    },
    comentar(_tweet_id, _item_index) {
      //salva comentario e add localmente
      fetch("/api/salvarcomenatrio", {
        method: "post",
        body: JSON.stringify({
          nome: this.usuario_nome,
          usuario_id: this.publicacao.usuario_id,
          tweet_id: _tweet_id,
          texto_comentario: this.texto_comentario
        }),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          console.log("Comentario Adicionado");
          this.tweets[_item_index].comentarios.push(data);
          this.texto_comentario = "";
        })
        .catch(error => console.log(error));
    },

    carregarFeed() {
      //carrega tweets, proprio e de usuarios que segue
      fetch("/api/carregarfeed", {
        method: "post",
        body: JSON.stringify(this.publicacao),
        headers: {
          "content-type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          this.organizarTweets(data);
        })
        .catch(error => console.log(error));
    },

    organizarTweets(array_tweets) {
      //organiza tweets
      for (let i = 0; i < array_tweets.length; i++)
        this.tweets = this.tweets.concat(array_tweets[i]);

      this.carregarComentarios();
    },

    carregarComentarios() {
      //busca comentarios para cada tweet
      for (let i = 0; i < this.tweets.length; i++) {
        fetch("/api/carregarcomentarios", {
          method: "post",
          body: JSON.stringify({ tweet_id: this.tweets[i].id }),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.tweets[i].comentarios = data;
          })
          .catch(error => console.log(error));
      }
      console.log("Comentarios Carregados");
    }
  },

  created() {
    //salva variaveis utilizadas no proximo componente no localStorange
    this.publicacao.usuario_id = localStorage.getItem("usuario_id");
    this.auth_token = localStorage.getItem("auth_token");
    this.usuario_nome = localStorage.getItem("usuario_nome");

    this.carregarFeed();
  }
};
</script>