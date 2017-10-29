<template>
    <div class="container">

                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" name="nome" id="nome" placeholder="Nome do paciente" class="form-control"
                                   v-model="paciente.nome">
                        </div>
                        <div class="form-group">
                            <label for="sus">Cartão SUS:</label>
                            <input type="text" name="sus" id="sus" placeholder="Cartão SUS" class="form-control"
                                   v-model="paciente.sus">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="paciente.description"></textarea>
                        </div>
        <div class="form-group">
            <select v-model="selected">
                <option value="abc">ABC</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                paciente: {
                    nome: '',
                    sus: '',
                    description: ''
                },
                errors: []
            }
        },
        methods: {
            initAddPaciente()
            {
                this.errors = [];
                $("#add_paciente_model").modal("show");
            },
            createPaciente()
            {
                axios.post('/paciente', {
                    name: this.paciente.nome,
                    sus: this.paciente.sus,
                    description: this.paciente.description,
                })
                    .then(response => {

                        this.reset();

                        $("#add_paciente_model").modal("hide");

                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.nome) {
                            this.errors.push(error.response.data.errors.nome[0]);
                        }
                        if (error.response.data.errors.sus) {
                            this.errors.push(error.response.data.errors.sus[0]);
                        }

                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            },
            reset()
            {
                this.task.nome = '';
                this.task.sus = '';
                this.task.description = '';
            },
        }
    }
</script>