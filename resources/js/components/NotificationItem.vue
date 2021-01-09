<template>
  <div class="block no-underline text-90 hover:bg-30 p-3">
    <div class="flex justify-between">
      <notification-link
          @click.native="markAsRead()"
          :href="formatRouterLink(notification)"
          :external="notification.data.external"
          :classList="['no-underline', 'text-black', 'flex-1', 'w-full']"
      >
        <slot name="content" class="w-full">
          <div class="flex justify-between items-center">
            <h4 class="no-underline dim text-primary font-bold pb-2">{{ notification.data.title }}</h4>
          </div>
          <p
              v-if="notification.data.subtitle"
              class="pb-2 font-normal"
          >
            {{ notification.data.subtitle }}
          </p>
          <p
              class="pb-2 font-normal"
              v-if="'actions' in notification.data">
            <button
                v-for="action in notification.data.actions || []"
                :key="action.label"
                :class="(action.classes || '') + ' text-black no-underline mr-3'"
                @click.stop="handleAction(action)"
                :href="action.url"
                v-text="action.label"
            >
            </button>
          </p>
          <p class="font-normal text-sm">
            {{ notification.data.created_at | fromNow }}
          </p>
        </slot>
      </notification-link>
      <button
          v-if="notification.read_at === null"
          @click.stop="markAsRead()"
          class="btn"
      >
        <slot name="action">
          {{ __('mark read') }}
        </slot>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    notification: {
      type: Object
    }
  },
  filters: {
    fromNow(date) {
      return new moment(date).fromNow()
    }
  },
  methods: {
    markAsRead: function () {
      axios
          .patch('/nova-vendor/nova-notifications/' + this.notification.id)
          .then(response => {
            if (response.data.notification.read_at) {
              Nova.$emit('notification-read', {notification: response.data.notification})
            }
          })
    },
    formatRouterLink: function (notification) {
      if (notification.data.route) {
        return {name: notification.data.route.name, params: notification.data.route.params}
      }

      if (notification.data.external) {
        return notification.data.url || '#'
      }

      return {path: notification.data.url || '#'}
    },
    async handleAction(action) {
      axios.get(action.url)
          .then(() => {
            Nova.success('Action completed successfully')
            this.markAsRead();
          })
      .catch(() => {
        Nova.error('Action unsuccessful')
      })
    }
  }
}
</script>
