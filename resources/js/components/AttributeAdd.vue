<template>
    <div class="form-group">
        <div class="row" v-for="(attributeValueInput,index) in attributeValueInputs" :key="index">
            <div class="col-5">
                <div class="form-group">
                    <label> Name Attribute</label>
                    <v-select taggable :options="attributeValueInput.attributes"
                              v-model="attributeValueInput.selectAttribute"
                              @input="selectAttributeValues(attributeValueInput)"
                              :id="'attribute-'+index"
                    ></v-select>
                    <input type="hidden" :name="'attributes['+index+'][name]'"
                           :value="attributeValueInput.selectAttribute">
                </div>
            </div>
            <div class="col-5">
                <div class="form-group">
                    <label>Value Attribute</label>
                    <v-select taggable
                              :options="attributeValueInput.values"
                              v-model="attributeValueInput.selectValue"
                              :id="'value-'+index"
                    ></v-select>
                    <input type="hidden" :name="'attributes['+index+'][value]'"
                           :value="attributeValueInput.selectValue">
                </div>
            </div>
            <div class="col-2">
                <label>Actions</label>
                <div>
                    <button type="button" class="btn btn-sm btn-warning"
                            @click="onDeleteAttributeValue(attributeValueInput.id)">Delete
                    </button>
                </div>
            </div>

        </div>
        <button class="btn btn-sm btn-outline-danger" type="button" @click="addAttribute()">New Attribute</button>
    </div>
</template>
<script>
export default {
    name: "AttributeAdd",
    props: ['attributesProduct'],

    data:()=> ({
        attributeValueInputs: [],
        attributesGet: [],
    }),
    mounted() {
        if(this.attributesProduct){
            this.attributesProduct = JSON.parse(this.attributesProduct)
        }
        axios.get('/admin/attributes')
            .then(resp => this.attributesGet = resp.data)
            .catch(resp => alert("Could not load attribute" + resp));
    },
    methods: {
        addAttribute() {
            const newAttributeValue = {
                id: Math.random() * Math.random() * 1000,
                attributes: this.attributesGet,
                values: [],
                selectAttribute: '',
                selectValue: '',
            };
            this.attributeValueInputs.push(newAttributeValue);
        },
        onDeleteAttributeValue(id) {
            this.attributeValueInputs = this.attributeValueInputs.filter(attrValue => attrValue.id !== id);
        },
        selectAttributeValues(attrValueInput) {
            if (attrValueInput.selectAttribute) {
                axios.get('/admin/attribute/values/' + attrValueInput.selectAttribute)
                    .then(resp => attrValueInput.values = resp.data)
                    .catch(resp => console.log('could not values' + resp));
            } else {
                attrValueInput.values = '';
            }
        },
    },
}
</script>
<style scoped>
</style>
