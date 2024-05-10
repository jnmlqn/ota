<template>
    <div>
        <h5 class="mb-3 mt-3">Create Job</h5>

        <div class="p-3 smaller">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" v-model="job.title">
                <span class="text-danger smaller">{{ validation.title }}</span>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" v-model="job.description"></textarea>
                <span class="text-danger smaller">{{ validation.description }}</span>
            </div>

            <div class="mb-3">
                <label for="sub_company" class="form-label">Sub-company</label>
                <input type="text" class="form-control" id="sub_company" v-model="job.sub_company">
                <span class="text-danger smaller">{{ validation.sub_company }}</span>
            </div>
            
            <div class="mb-3">
                <label for="office" class="form-label">Office</label>
                <input type="text" class="form-control" id="office" v-model="job.office">
                <span class="text-danger smaller">{{ validation.office }}</span>
            </div>
            
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" v-model="job.department">
                <span class="text-danger smaller">{{ validation.department }}</span>
            </div>
            
            <div class="mb-3">
                <label for="recruiting_category" class="form-label">Recruiting Category</label>
                <input type="text" class="form-control" id="recruiting_category" v-model="job.recruiting_category">
                <span class="text-danger smaller">{{ validation.recruiting_category }}</span>
            </div>
            
            <div class="mb-3">
                <label for="employment_type" class="form-label">Employment Type</label>
                <select class="form-control" id="employment_type" v-model="job.employment_type">
                    <option value="permanent">Permanent</option>
                    <option value="contractual">Contractual</option>
                    <option value="project_based">Project-based</option>
                </select>
                <span class="text-danger smaller">{{ validation.employment_type }}</span>
            </div>
            
            <div class="mb-3">
                <label for="seniority" class="form-label">Seniority</label>
                <select class="form-control" id="seniority" v-model="job.seniority">
                    <option value="entry_level">Entry level</option>
                    <option value="junior">Junior</option>
                    <option value="mid">Mid level</option>
                    <option value="senior">Senior level</option>
                    <option value="experienced">Experienced</option>
                </select>
                <span class="text-danger smaller">{{ validation.seniority }}</span>
            </div>
            
            <div class="mb-3">
                <label for="schedule" class="form-label">Schedule</label>
                <select class="form-control" id="schedule" v-model="job.schedule">
                    <option value="full_time">Full-time</option>
                    <option value="part_time">Part-time</option>
                </select>
                <span class="text-danger smaller">{{ validation.schedule }}</span>
            </div>
            
            <div class="mb-3">
                <label for="years_of_exp" class="form-label">Years of Exp</label>
                <input type="number" class="form-control" id="years_of_exp" v-model="job.years_of_exp">
                <span class="text-danger smaller">{{ validation.years_of_exp }}</span>
            </div>
            
            <div class="mb-3">
                <label for="keywords" class="form-label">Keywords (separate by ',')</label>
                <input type="text" class="form-control" id="keywords" v-model="job.keywords">
                <span class="text-danger smaller">{{ validation.keywords }}</span>
            </div>
            
            <div class="mb-3">
                <label for="occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="occupation" v-model="job.occupation">
                <span class="text-danger smaller">{{ validation.occupation }}</span>
            </div>
            
            <div class="mb-3">
                <label for="occupation_category" class="form-label">Occupation Category</label>
                <input type="text" class="form-control" id="occupation_category" v-model="job.occupation_category">
                <span class="text-danger smaller">{{ validation.occupation_category }}</span>
            </div>

            <p class="success text-success">
                {{ success }}
            </p>

            <p class="error text-danger">
                {{ error }}
            </p>

            <button type="button" class="btn btn-primary float-end" @click="save()">
                Create Job
            </button>
        </div>
    </div>
</template>

<script>
import Api from '../helpers/api.ts';

export default {
    data() {
        return {
            success: '',
            error: '',
            api: new Api,
            validation: {
                title: '',
                description: '',
                sub_company: '',
                office: '',
                department: '',
                recruiting_category: '',
                employment_type: '',
                seniority: '',
                schedule: '',
                years_of_exp: '',
                keywords: '',
                occupation: '',
                occupation_category: '',
            },
            job: {
                title: '',
                description: '',
                sub_company: '',
                office: '',
                department: '',
                recruiting_category: '',
                employment_type: '',
                seniority: '',
                schedule: '',
                years_of_exp: '',
                keywords: '',
                occupation: '',
                occupation_category: '',
            }
        };
    },

    mounted() {
        this.api.checkAuth();
    },

    methods: {
        save() {
            this.validation = {
                title: '',
                description: '',
                sub_company: '',
                office: '',
                department: '',
                recruiting_category: '',
                employment_type: '',
                seniority: '',
                schedule: '',
                years_of_exp: '',
                keywords: '',
                occupation: '',
                occupation_category: '',
            };

            this.success = '';
            this.error = '';

            this.api.post('job-posts', this.job)
            .then((response) => {
                this.success = response.data.message;

                this.job = {
                    title: '',
                    description: '',
                    sub_company: '',
                    office: '',
                    department: '',
                    recruiting_category: '',
                    employment_type: '',
                    seniority: '',
                    schedule: '',
                    years_of_exp: '',
                    keywords: '',
                    occupation: '',
                    occupation_category: '',
                }
            })
            .catch((error) => {
                if (error.response.status === 422) {
                    const errorMessages = error.response.data.data.errors;

                    console.log(errorMessages);

                    for (const [key, value] of Object.entries(errorMessages)) {
                        this.validation[key] = value.join(', ');
                    }
                } else {
                    this.error = error.response.message;
                }
            });
        }
    },
};
</script>

<style type="text/css" scoped>
    .smaller {
        font-size: .9em;
    }
    .success, .error {
        text-align: center;
    }
</style>