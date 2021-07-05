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
        <button class="btn btn-sm btn-outline-primary" type="button"
                @click="attributes()"
                v-if="showAttributes"
        >
            Attributes Product
        </button>
        <button class="btn btn-sm btn-outline-danger" type="button" @click="addAttribute()">New Attribute</button>
    </div>
</template>
<script>
export default {
    name: "AttributeAdd",
    props: ['attributesProduct'],

    data: () => ({
        attributeValueInputs: [],
        attributesGet: [],
        valuesData: [],
        showAttributes: true,
    }),
    mounted() {
        axios.get('/admin/attributes')
            .then(resp => this.attributesGet = resp.data)
            .catch(resp => alert("Could not load attribute" + resp));
        if (this.attributesProduct === '') {
            this.showAttributes = false;
        }
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
        attributes() {
            if (this.attributesProduct.length) {
                this.attributesProduct.forEach((element) => {
                        axios.get('/admin/attribute/values/' + element[0])
                            .then((resp) => {
                                const newAttributeValue1 = {
                                    id: Math.random() * Math.random() * 1000,
                                    attributes: this.attributesGet,
                                    values: resp.data,
                                    selectAttribute: element[0],
                                    selectValue: element[1],
                                };
                                this.attributeValueInputs.push(newAttributeValue1);
                            })
                            .catch(resp => console.log('could not values' + resp));
                    }
                );
            } else {
                console.log('null')
            }
            this.showAttributes = false;
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
                attrValueInput.values = [''];
                attrValueInput.selectValue = '';
            }
        },
    },
}
</script>
<style scoped>
</style>
