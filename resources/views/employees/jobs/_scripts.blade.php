
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    display: ['"Plus Jakarta Sans"', 'sans-serif'],
                    body: ['"Inter"', 'sans-serif'],
                },
                colors: {
                    ink:     '#12203D',
                    slate2:  '#5B6478',
                    brand:   '#3457D5',
                    brand2:  '#7B8FF7',
                    coral:   '#FF6B4A',
                    surface: '#F5F7FC',
                    line:    '#E8EAF3',
                    mint:    '#16A34A',
                },
                boxShadow: {
                    card: '0 1px 2px rgba(18,32,61,0.04), 0 8px 24px -12px rgba(18,32,61,0.10)',
                    cardHover: '0 4px 10px rgba(18,32,61,0.06), 0 16px 32px -14px rgba(52,87,213,0.18)',
                }
            }
        }
    }
</script>