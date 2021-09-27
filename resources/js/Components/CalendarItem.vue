<template>
    <div
        class="rounded-lg text-white flex justify-between items-start pt-3 pb-6 px-3 cursor-pointer to-delete  transition-all relative "
        :class="{
            'bg-red-700 hover:bg-red-600': !free,
            'bg-green-500 hover:bg-green-600': free,
            'my-6 mx-4 text-base': typeCalendar === 'local',
            'my-3 text-xs': typeCalendar === 'global'
        }"
        @click="clickItem()"
    >
        <div>{{ dataTime ? dataTime.hour : "" }}</div>
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
        <div
            class="z-40 hover:shadow-lg bg-white rounded-xl text-black text-sm py-2 px-4 -bottom-4 left-1/2 transform -translate-x-2/4 absolute cursor-pointer delete-me"
            :class="{
                hidden: !showButton
            }"
            @click="clickButton(buttonType)"
        >
            {{ buttonType === 0 ? "To book" : "Delete me" }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        dataIndex: Number,
        dataTime: Object,
        dataUsers: Array,
        typeCalendar: String
    },
    data() {
        return {
            showButton: 0
        };
    },
    mounted() {},
    computed: {
        free() {
            return this.dataUsers ? 0 : 1;
        },
        buttonType() {
            let type = 0;
            for (let key in this.dataUsers) {
                if (this.dataUsers[key]["id"] === +this.$userId) {
                    type = 1;
                }
            }
            return type;
        }
    },
    methods: {
        clickItem() {
            this.showButton = !this.showButton;
        },
        clickButton(type) {
            let data = {};
            data.type = type;
            data.time = this.dataTime.dateTime;
            axios
                .get("/calendar/userHour/" + JSON.stringify(data))
                .then(res => {
                    this.setDataUsers(this.dataTime.dateTime);
                });
        },
        setDataUsers(time) {
            axios.get("/calendar/itemUsers/" + time).then(res => {
                this.dataUsers = res.data;
            });
        }
    }
};
</script>

<style></style>
