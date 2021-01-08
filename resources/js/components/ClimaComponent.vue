<template>
    <div class="col-md-4">
        <div class="card card-plain card-blog">
            <div class="card-header card-header-image">
                <iframe :src="iframeUrl" style="width: 100%;" frameborder="0"  allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                <div class="colored-shadow" ></div></div>
            <div class="card-body">
                <h6 class="card-category">
                    <a href="/" class="text-dark">Hoy</a>
                </h6>
                <h4 class="card-title">
                   {{location.toUpperCase()}} {{results.location.region}}                    
                </h4>                 
             
                    <div class="card card-pricing card-plain" style="margin-top: 0">
                        <div class="card-body "> 
                            <h1 class="card-title">
                            <small>
                                <img src="https://ssl.gstatic.com/onebox/weather/64/partly_cloudy.png" alt="">
                            </small>
                            {{results.current_observation.condition.temperature}}
                            <small>°C</small>
                        </h1>
                        <ul>
                            <li>
                            <b>{{results.current_observation.atmosphere.humidity}}%</b> Humedad</li>
                            <li>
                            <b>{{results.current_observation.wind.speed}} km/h</b> Viento</li>
                            <li>
                            <b>{{results.current_observation.condition.text}}</b> Condición</li>                             
                        </ul>
                    </div>
                <div class="card-footer justify-content-center">
                    <div class="table-responsive">
                        <table class="grid" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td v-for="item in results.forecasts" :key="item.id" >                                      
                                        <b>{{item.day}}</b>                                    
                                        <p style="font-size: 12px;">Bajo: {{item.low}}°C </p>                               
                                        <p style="font-size: 12px;">Alto: {{item.high}}°C</p>
                                    </td>                                   
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>                            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['iframeUrl', 'location'],
        data() {
            return {
                results: [],                
            }
        },
        created() {
            this.resultsGet();
        },
        methods:{
            resultsGet(){
                let url = '/api/weather/'+this.location;
                axios.get(url)
                    .then((response) => {
                         this.results = response.data;
                    });
            }
        }
         
    }
</script>
