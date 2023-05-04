<script>
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

export default {
  setup() {
    const user = JSON.parse(localStorage.getItem("user"));
    const targetedUser = ref({});
    const messages = ref(null);
    const route = useRoute();
    const content = ref(null);
    const sender_id = ref(user.id);
    const receiver_id = ref(route.params.id);
    onMounted(() => {
      getUser();
      getMessages();
    });

    async function getUser() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/users/${user.id}`
        );
        targetedUser.value = response.data;
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    }

    async function getMessages() {
      let fr = new FormData();
      fr.append("sender_id", user.id);
      axios
        .post(`http://127.0.0.1:8000/api/messages/${route.params.id}`, fr)
        .then((response) => {
          messages.value = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    }

    async function send() {
      let messageData = {
        content: content.value,
        sender_id: sender_id.value,
        receiver_id: receiver_id.value,
      };
      axios
        .post(`http://127.0.0.1:8000/api/send`, messageData)
        .then((response) => {
          console.log(response.data);
          getMessages();
          content.value = "";
        })
        .catch((error) => {
          console.log(error);
        });
    }

    watch(
      () => route.params.id,
      () => {
        getMessages();
      }
    );

    return {
      user,
      targetedUser,
      messages,
      content,
      sender_id,
      receiver_id,
      send,
    };
  },
};
</script>

<template>
  <div class="flex mx-6 mt-10 gap-4 pb-10">
    <div class="lg:w-1/4 w-20 rounded border border-2 border-gray-300">
      <div class="bg-gray-100 py-2 px-2">Message</div>
      <div class="grid gap-2 px-2 mt-2">
        <div
          v-for="follower in targetedUser.followers"
          :key="follower.user_id"
          class="flex lg:justify-stretch justify-center gap-2"
        >
          <router-link
            :to="{ name: 'chat', params: { id: follower.follower.id } }"
          >
            <img
              :src="'../src/assets/users/' + follower.follower.avatar"
              class="bg-gray-300 w-10 h-10 rounded-full"
            />
          </router-link>
          <router-link
            class="lg:flex hidden mt-1"
            :to="{ name: 'chat', params: { id: follower.follower.id } }"
            >{{ follower.follower.name }}</router-link
          >
        </div>
      </div>
    </div>
    <div
      class="lg:w-1/2 w-full border border-2 border-gray-300 rounded shadow-md pb-6 grid gap-10"
    >
      <div class="bg-gray-200 py-2 px-2">Messages</div>
      <div class="md:mx-4 mx-2 overflow-auto">
        <div class="grid" v-for="message in messages" :key="message.sender_id">
          <div
            v-if="message.sender_id === user.id"
            class="flex gap-2 items-center justify-self-end mt-4"
          >
            <h1 class="rounded-tl-xl bg-green-500 px-2 py-2">
              {{ message.content }}
            </h1>
            <img
              :src="'../src/assets/users/' + message.sender.avatar"
              class="bg-gray-300 w-10 h-10 rounded-full"
            />
          </div>
          <div v-else class="flex items-center gap-2 mt-4">
            <img
              :src="'../src/assets/users/' + message.sender.avatar"
              class="bg-gray-300 w-10 h-10 rounded-full"
            />
            <h1 class="rounded-tr-xl bg-blue-500 px-2 py-2 w-fit">
              {{ message.content }}
            </h1>
          </div>
        </div>
      </div>
      <div class="flex gap-2 md:mx-4 mx-2">
        <input
          type="text"
          class="w-full px-2 py-2 border border-2 border-blue-400 rounded"
          name="content"
          placeholder="Your message..."
          v-model="content"
        />
        <button
          @click="send()"
          class="bg-black text-gray-100 px-2 py-2 rounded"
        >
          Send
        </button>
      </div>
    </div>
  </div>
</template>
