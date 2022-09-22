<?php

return [
    'home' => [
        'dashboard' => [
            'success' => [
                'code' => '',
                'message' => ''
            ],
            'fail' => [
                'code' => 'HM_DB_E1',
                'message' => ''
            ],
        ],
    ],
    'member' => [
        'update' => [
            'success' => [
                'code' => '',
                'message' => '회원정보가 변경되었습니다.'
            ],
            'fail' => [
                'code' => 'MB_ED_E1',
                'message' => '문제가 발생하였습니다. 다시 시도 해주세요.'
            ],

            'password' => [
                'success' => [
                    'code' => '',
                    'message' => '패스워드가 변경되었습니다.'
                ],
                'fail' => [
                    'code' => 'MB_ED_PW_E1',
                    'message' => '문제가 발생하였습니다. 다시 시도 해주세요.'
                ],
            ],
        ],

        'cart' => [
            'store' => [
                'success' => [
                    'code' => '',
                    'message' => '장바구니에 추가 되었습니다.'
                ],
                'fail' => [
                    'code' => 'MB_CT_ST_E1',
                    'message' => '장바구니에 추가 되지 않았습니다.'
                ],
            ],
            'destroy' => [
                'success' => [
                    'code' => '',
                    'message' => '장바구니에서 삭제 되었습니다.'
                ],
                'fail' => [
                    'code' => 'MB_CT_DT_E1',
                    'message' => '장바구니에서 삭제 되지 않았습니다.'
                ],
            ],
        ],
        'coupon' => [
            'use' => [
                'success' => [
                    'code' => '',
                    'message' => '쿠폰 등록이 되었습니다.'
                ],
                'fail' => [
                    'code' => 'MB_CP_USE_E1',
                    'message' => '쿠폰 등록이 되지 않았습니다.'
                ],
            ],
        ],
    ],
    'qna' => [
        'store' => [
            'success' => [
                'code' => '',
                'message' => '1:1 문의가 등록 되었습니다.'
            ],
            'fail' => [
                'code' => 'QNA_ST_E1',
                'message' => '1:1 문의가 등록에 실패하였습니다.'
            ],
        ],
        'update' => [
            'success' => [
                'code' => '',
                'message' => '1:1 문의가 수정 되었습니다.'
            ],
            'fail' => [
                'code' => 'QNA_UP_E1',
                'message' => '1:1 문의 수정에 실패하였습니다.'
            ],
        ],
        'destroy' => [
            'success' => [
                'code' => '',
                'message' => '1:1 문의가 삭제 되었습니다.'
            ],
            'fail' => [
                'code' => 'QNA_DT_E1',
                'message' => '1:1 문의 삭제에 실패하였습니다.'
            ],
        ],
    ],
    'lecture' => [
        'payment' => [
            'ready' => [
                'success' => [
                    'code' => '',
                    'message' => '결제 정보 호출이 되었습니다'
                ],
                'fail' => [
                    'code' => 'LT_PY_RD_E1',
                    'message' => '결제 정보 호출에 문제가 발생하였습니다.'
                ],
            ],
            'hooks' => [
                'success' => [
                    'code' => '',
                    'message' => 'successfully received webhook'
                ],
                'fail' => [
                    'code' => 'LT_PY_HK_E1',
                    'message' => 'an error received webhook'
                ],
            ],
        ],
        'playing' => [
            'success' => [
                'code' => '',
                'message' => '강의 수강 정보를 저장 하였습니다.'
            ],
            'fail' => [
                'code' => 'LT_PY_E1',
                'message' => '강의 수강 중 문제가 생겼습니다.'
            ],
        ],
        'exam' => [
            'store' => [
                'success' => [
                    'code' => '',
                    'message' => '문제 답변을 저장 하였습니다.'
                ],
                'fail' => [
                    'code' => 'LT_EX_ST_E1',
                    'message' => '문제 답변을 저장하는 중 문제가 발생 하였습니다.'
                ],
            ],
            'submit' => [
                'success' => [
                    'code' => '',
                    'message' => '시험 제출을 하였습니다.'
                ],
                'fail' => [
                    'code' => 'LT_EX_SM_E1',
                    'message' => '시험 제출 중 문제가 발생 하였습니다.'
                ],
            ],
        ],
    ],
];
