$(document).ready( function() {
	window.setTimeout(function() { $("#msg-flash").alert('close'); }, 4000);
	
	$(function($){
	   $("#telefone_cliente").mask("(99) 9999-9999?9");
	});
	
    $("#adicionar_cliente_form").validate({
        rules:{
            nome_cliente:{
                required: true
            },
            email_cliente:{
                required: true, email: true
            },
          telefone_cliente:{
        	    required: true
            }
        },
        messages:{
            nome_cliente:{
                required: "Campo de preenchimento obrigatório",
            },
            email_cliente:{
                required: "Campo de preenchimento obrigatório",
                email: "Digite um e-mail válido"
            },
            telefone_cliente:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
    
    $("#editar_cliente_form").validate({
        rules:{
            nome_cliente:{
                required: true
            },
            email_cliente:{
                required: true, email: true
            },
			telefone_cliente:{
        	    required: true
            }
        },
        messages:{
            nome_cliente:{
                required: "Campo de preenchimento obrigatório",
            },
            email_cliente:{
                required: "Campo de preenchimento obrigatório",
                email: "Digite um e-mail válido"
            },
            telefone_cliente:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
    
    $("#adicionar_pedido_form").validate({
        rules:{
            produto:{
                required: true
            },
            cliente:{
                required: true
            }
        },
        messages:{
            produto:{
                required: "Campo de preenchimento obrigatório",
            },
            cliente:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
    
    $("#editar_pedido_form").validate({
        rules:{
            produto:{
                required: true
            },
            cliente:{
                required: true
            }
        },
        messages:{
            produto:{
                required: "Campo de preenchimento obrigatório",
            },
            cliente:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
    
    $("#adicionar_produto_form").validate({
        rules:{
            nome_produto:{
                required: true
            },
            descricao_produto:{
                required: true
            },
			preco_produto:{
				required: true
			}
        },
        messages:{
            nome_produto:{
                required: "Campo de preenchimento obrigatório",
            },
            descricao_produto:{
                required: "Campo de preenchimento obrigatório",
                email: "Digite um e-mail válido"
            },
            preco_produto:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
    
    $("#editar_produto_form").validate({
        rules:{
            nome_produto:{
                required: true
            },
            descricao_produto:{
                required: true
            },
          preco_produto:{
        	    required: true
            }
        },
        messages:{
            nome_produto:{
                required: "Campo de preenchimento obrigatório",
            },
            descricao_produto:{
                required: "Campo de preenchimento obrigatório",
                email: "Digite um e-mail válido"
            },
            preco_produto:{
                required: "Campo de preenchimento obrigatório",
            }
        }
    });
});