<template>
    <div
        class="rounded-lg text-white flex justify-between items-start pt-3 pb-6 px-3 to-delete transition-all relative"
        :class="{
            'bg-red-700 hover:bg-red-600': !free,
            'bg-green-500 hover:bg-green-600': free,
            'my-6 mx-4 text-base': typeCalendar === 'local',
            'my-3 text-xs': typeCalendar === 'global',
        }"
        @mouseover="showButton = true"
        @mouseleave="showButton = false">
        <div>{{ dataTime ? dataTime.hour : '' }}</div>
        <div class="flex flex-col">
            <div v-if="!free">
                <p v-for="(user, userIndex) in dataUsers" :key="userIndex">
                    {{ user.name }}
                </p>
            </div>
            <div v-else>
                <p>Free</p>
            </div>
        </div>
        <div></div>
        <button
            class="z-40 hover:shadow-lg bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute delete-me"
            :class="{ hidden: !showButton, 'bg-gray-100': isAddedLoading }"
            :disabled="isAddedLoading"
            @click.stop="clickButton(buttonType)">
            {{ buttonType === 0 ? 'To book' : 'Delete me' }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        dataIndex: Number,
        dataTime: Object,
        dataUsers: Array,
        typeCalendar: String,
    },
    model: {
        prop: 'dataUsers',
        event: 'change',
    },
    data() {
        return {
            showButton: 0,
            isAddedLoading: false,
        };
    },
    mounted() {},
    computed: {
        free() {
            return this.dataUsers && this.dataUsers.length !== 0 ? false : true;
        },
        buttonType() {
            return this.dataUsers && this.dataUsers.find((u) => u.id == this.$userId) ? 1 : 0;
        },
    },
    methods: {
        clickButton(type) {
            this.isAddedLoading = true;
            const data = { type, time: this.dataTime.dateTime };
            axios.get('/calendar/userHour/' + JSON.stringify(data)).then((res) => {
                this.setDataUsers(data.time);
            });
        },
        setDataUsers(time) {
            axios.get('/calendar/itemUsers/' + time).then((res) => {
                const users = res.data || [];
                socket.emit('calendar:speak', { index: this.dataIndex, time, users });
                this.$emit('change', users);
                this.isAddedLoading = false;
            });
        },
    },
};
</script>
