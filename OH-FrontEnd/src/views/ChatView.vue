<script>
import { onMounted, ref, watch } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

export default {
  setup() {
    const followers = ref(null);
    const messages = ref(null);
    const route = useRoute();
    const content = ref(null);
    const message_from = ref(100);
    const message_to = ref(route.params.id);
    onMounted(() => {
      getUserFollowers();
      getMessages();
    });

    async function getUserFollowers() {
      axios
        .get("http://127.0.0.1:8000/api/users/follows/100")
        .then((response) => {
          followers.value = response.data[0].followers;
        })
        .catch((error) => {
          console.log(error);
        });
    }

    async function getMessages() {
      let fr = new FormData();
      fr.append("message_to", 100);
      axios
        .post(`http://127.0.0.1:8000/api/users/messages/${route.params.id}`, fr)
        .then((response) => {
          messages.value = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    }

    async function send() {
      let messageData = {
        content: content.value,
        message_from: message_from.value,
        message_to: message_to.value,
      };
      axios
        .post(`http://127.0.0.1:8000/api/messages/send`, messageData)
        .then((response) => {
          console.log(response.data);
          getMessages();
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

    return { followers, messages, content, message_from, message_to, send };
  },
};
</script>

<template>
  <div class="flex mx-6 mt-10 gap-4">
    <div class="md:w-1/5 rounded border border-2 border-gray-300">
      <div class="bg-gray-100 py-2 px-2">Message</div>
      <div class="grid gap-2 px-2 mt-2">
        <div
          v-for="follower in followers"
          :key="follower.user_id"
          class="flex items-center gap-2"
        >
          <img
            :src="follower.follower.photo"
            class="bg-gray-300 w-10 h-10 rounded-full"
          />
          <router-link
            class="md:flex hidden"
            :to="{ name: 'chat', params: { id: follower.follower.id } }"
            >{{ follower.follower.name }}</router-link>
        </div>
      </div>
    </div>
    <div
      class="md:w-1/2 w-full border border-2 border-gray-300 rounded shadow-md pb-6 grid gap-10"
    >
      <div class="bg-gray-200 py-2 px-2">Messages</div>
      <div class="md:mx-4 mx-2 overflow-auto">
        <div
          class="grid"
          v-for="message in messages"
          :key="message.message_from"
        >
          <div
            v-if="message.message_from == 100"
            class="flex gap-2 items-center justify-self-end mt-6"
          >
            <h1 class="rounded-tl-xl bg-green-500 px-2 py-2">
              {{ message.content }}
            </h1>
            <img
              :src="message.sender.photo"
              class="bg-gray-300 w-10 h-10 rounded-full"
            />
          </div>
          <div v-else class="flex items-center gap-2">
            <img
              :src="message.sender.photo"
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
