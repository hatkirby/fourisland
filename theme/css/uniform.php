/* Four Island UniForm CSS */

/* uniForm */
      .uniForm{
        margin:0; padding:0;
        position:relative;
        width:100%;
        /* user prefs */
        padding:10px 0;
      }

        /* Some generals */
        .uniForm fieldset{
          border:none;
          margin:0; padding:0;
          /* user prefs */
          margin:0 0 7px 0; padding:0 0 10px 0;
          border-bottom:1px solid #efefef;
        }
          .uniForm fieldset legend{
            color:#000; /* Reset IE */
            margin:0; padding:0;
            /* user prefs */
            margin:0 0 .5em 0;
            font:bold small-caps 100%/100% "lucida grande", "lucida sans unicode", "trebuchet ms", arial, verdana, sans-serif;
            letter-spacing:.1em;
            color:#93b5be;
          }

          .ctrlHolder{ /* This is the main unit that contains our form "modules" */
            overflow:hidden;
            margin:0; padding:0;
            clear:both;
            /* user prefs */
            background:#f9f9f9;
            margin:0; padding:7px 4px;
          }

          .buttonHolder{
            overflow:hidden;
            clear:both;
            /* user prefs */
            background:#f9f9f9;
            border:1px solid #ccc; border-width:1px 0;
            margin:10px 0 0 0; padding:10px;
            text-align:right;
          }
            .resetButton{
            }
            .submitButton{
            }

          .uniForm .inlineLabel{
            width:auto;
            float:none;
            display:inline;
            /* user prefs */
            margin:0 2em 0 0;
            font-weight:normal;
          }
            .uniForm .inlineLabel input{
            }
          
          /* Highlighting the rows on input focus */
          .focused{
            background:#FFFCDF url(/theme/images/uf_focused.png);
            border:1px solid #EFE795; border-width:1px 0;
            padding:6px 4px;
          }


          /* Styles for form controls where labels are in line with the input elements */
          /* Set the class to the parent to .inlineLabels */
          .inlineLabels .ctrlHolder{
          }
              .inlineLabels label,
              .inlineLabels .label{
                float:left;
                margin:.3em 0 0 0; padding:0;
                line-height:100%;
                /* user prefs */
                width:30%; 
                font-weight:bold;
              }

              .inlineLabels .textInput,
              .inlineLabels .fileUpload{
                float:left;
                /* user prefs */
                width:68%;
                border:2px solid #dfdfdf;
              }
              .inlineLabels .fileUpload > input{
              }
              
              .inlineLabels .selectInput{
                float:left;
                /* user prefs */
                width:69%;
                border:2px solid #dfdfdf;
              }

              .inlineLabels textarea{
                float:left;
                width:68%;
                /* user prefs */
                border:2px solid #dfdfdf;
                height:12em;
              }

            .inlineLabels .formHint{
              clear:both;
              /* user prefs */
              color:#999;
              margin:.5em 0 0 30%; padding:3px 0;
              font-size:80%;
            }
  
              /* inlineLabels esthetics */
              .inlineLabels .formHint strong{
                padding:0 0 0 14px; 
                background:url(/theme/images/icon_alert.png) 0 0 no-repeat;
                display:inline-block;
              }

  
          /* ########################################################################## */

          /* Styles for form controls where labels are above the input elements */
          /* Set the class to the parent to .blockLabels */
          .blockLabels .ctrlHolder{
          }

              .blockLabels label,
              .blockLabels .label{
                display:block;
                float:none;
                margin:.3em 0; padding:0;
                line-height:100%;
                width:60%;
                /* user prefs */
                font-weight:bold;
                width:auto;
              }
              .blockLabels .label{
                float:left;
                margin-right:3em;
              }

              .blockLabels .textInput{
                float:left;
                width:60%;
                /* user prefs */
                border:2px solid #dfdfdf;
              }
              
              .blockLabels .selectInput{
                float:left;
                width:60%;
                /* user prefs */
                border:2px solid #dfdfdf;
                
              }

              .blockLabels textarea{
                display:block;
                float:left;
                /* user prefs */
                border:2px solid #dfdfdf;
                height:12em;
              }

            .blockLabels .formHint{
              float:right;
              margin:0;
              width:38%;
              clear:none;
              /* user prefs */
              color:#999;
              font-size:80%;
              font-style:italic;
            }

            /* blockLabels esthetics */
            .blockLabels .ctrlHolder{
              border:1px solid #dfdfdf; border-width:1px 0;
              margin-top:-1px;
            }

            .blockLabels .focused{
              padding:7px 4px;
            }

          /* ########################################################################## */

          /* Focus pseudoclasses */
          .ctrlHolder .textInput:focus{
            border-color:#DFD77D;
          }
          div.focused .textInput:focus{
          }
          div.focused .formHint{
            color:#000;
          }

          /* Required asterisk styling, use if needed */
          label em,
          .label em{
            display:block;
            position:absolute; left:28%;
            font-style:normal;
            font-weight:bold;
          }
          .blockLabels label em,
          .blockLabels .label em{
            position:static;
            display:inline;
          }

          /* Messages */
          .uniForm #errorMsg{
            background:#ffdfdf url(/theme/images/uf_error.png);
            border:1px solid #df7d7d; border-width:1px 0;
            margin:0 0 1em 0; padding:1em;
          }
          .uniForm .error,
          .uniForm .blockLabels.ctrlHolder.error{
            background:#ffdfdf url(/theme/images/uf_error.png);
            border:1px solid #df7d7d; border-width:1px 0;
            position:relative;
          }
            .uniForm #errorMsg dt,
            .uniForm #errorMsg h3{
              margin:0 0 .5em 0;
              font-size:110%;
              line-height:100%;
              font-weight:bold;
              color:#000;
              padding:2px 0 2px 18px;
              background:url(/theme/images/icon-error.png) 0 0 no-repeat;
            }
            .uniForm #errorMsg dd{
              margin:0; padding:0;
            }
              .uniForm #errorMsg ol{
                margin:0; padding:0;
              }
                .uniForm #errorMsg ol li{
                  margin:0; padding:2px;
                  list-style-position:inside;
                  border-bottom:1px dotted #df7d7d;
                  position:relative;
                }
              .uniForm .errorField{
                margin:0 0 3px 0;
              }
              .uniForm .inlineLabels .errorField{
                margin-left:30%;
              }
                .uniForm .errorField strong{
                  background:#FFE2E2;
                  padding:1px 3px 3px 3px;
                  }
             .ctrlHolder.error input,
             .ctrlHolder.error input:focus{
               border-color:#DF7D7D;
             }
             .ctrlHolder.error.focused{
               padding:7px 4px;
             }
