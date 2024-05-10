<template>
    <div>
        <h5 class="mb-3 mt-3">Job Board</h5>

        <div class="card p-3 mb-2" v-for="job in jobs">
           <p class="smaller">
               <span class="fw-bold">Title:</span> {{ job.title }}
           </p>
           <p class="smaller">
                <span class="fw-bold">Description:</span> <span v-html="job.description"></span>
           </p>

            <div class="d-flex flex-row bd-highlight smallest">
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Sub-company:</span> {{ job.sub_company }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Office:</span> {{ job.office }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Department:</span> {{ job.department }}
                </div>
            </div>

            <div class="d-flex flex-row bd-highlight smallest">
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Recruiting Category:</span> {{ job.recruiting_category }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Employment Type:</span> {{ job.employment_type }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Seniority:</span> {{ job.seniority }}
                </div>
            </div>

            <div class="d-flex flex-row bd-highlight smallest">
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Schedule:</span> {{ job.schedule }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Years of Experience:</span> {{ job.years_of_exp }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Keywords:</span> {{ job.keywords.join(', ') }}
                </div>
            </div>

            <div class="d-flex flex-row bd-highlight smallest">
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Occupation:</span> {{ job.occupation }}
                </div>
                <div class="p-2 bd-highlight">
                    <span class="fw-bold">Occupation Category:</span> {{ job.occupation_category }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Api from '../helpers/api.ts';

export default {
    data() {
        return {
            api: new Api,
            jobs: {}
        };
    },

    mounted() {
        this.api.checkAuth();
        this.getJobs();
    },

    methods: {
        getJobs() {
            this.api.get('job-posts')
            .then((response) => {
                this.jobs = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },
};
</script>

<style type="text/css" scoped>
    .smaller {
        font-size: .9em;
    }
    .smallest {
        font-size: .8em;
    }
</style>