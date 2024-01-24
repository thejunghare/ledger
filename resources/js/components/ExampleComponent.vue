<template>
    <div>
        <!-- check button -->
        <div class="form-check form-switch mb-2">
            <input
                class="form-check-input"
                type="checkbox"
                role="switch"
                id="flexCheckDefault"
                v-model="isChecked"
            />
            <label class="form-check-label" for="switchCheckDefault"
                >Set category wise budget [Check if want set category to your
                budgets]</label
            >
        </div>

        <!-- elements -->
        <div v-if="isChecked">
            <form class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Category</label>
                    <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="inputCity" class="form-label">Amount</label>
                    <input type="text" class="form-control" id="inputCity" />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },

    data() {
        return {
            isChecked: false,
        };
    },
};
</script>
